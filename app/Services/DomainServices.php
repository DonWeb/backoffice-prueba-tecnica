<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Iodev\Whois\Factory;

class DomainServices
{
    /**
     * Recibe como parametro un dominio y retorna la fecha de vencimiento o un mensaje
     *
     * @param  string  $domain
     * @return string
     */
    public static function domainExpired(string $domain): string
    {
        $response = Http::get("https://rdap.nic.ar/domain/{$domain}");

        // Uso la función str_ends_with disponible en php8 para verificar la terminación del string que sea .com.ar
        // Uso la libreria Whois para verificar si el dominio esta disponible y podes sacar fecha de vencimiento o si esta libre..
        if (self::domainAvailable($domain) && str_ends_with($domain, '.com.ar')) {
            $domainData = json_decode($response->getBody(), true);

            foreach ($domainData['events'] as $event) {
                if ($event['eventAction'] === 'expiration') {
                    return 'El dominio vence el día: '.Carbon::parse($event['eventDate'])->format('d-m-Y H:i:s');
                }
            }
        } else {
            return 'No podemos obtener información del dominio, puede que este disponible para su uso o hubo un error en la petición. Verifique!!!';
        }
    }

    /**
     * Recibe como parametro un dominio y verifica si el dominio esta disponible o esta asignado a alguien
     *
     * @param  string  $domain
     * @return bool
     */
    private static function domainAvailable(string $domain): bool
    {
        $whois = Factory::get()->createWhois();
        $info = $whois->loadDomainInfo($domain);
        if (! $info) {
            return  false;
        }

        return  true;
    }

    /**
     * Recibe como parametro un dominio y retorna JsonResponse con los Name Server
     *
     * @param  string  $domain
     * @return JsonResponse
     */
    public function getNameServer(string $domain): JsonResponse
    {
        $message = [];
        if (self::domainAvailable($domain) && str_ends_with($domain, '.com')) {
            //Donde guardo los dats recibios
            $infomacion = [];
            //Nombre del servidor WOIS
            $serverWois = 'whois.donweb.com';

            /**
             * el método fsockopen abre una conexión vía sockets a Internet
             * y devuelve un puntero
             */
            $sock = fsockopen($serverWois, 43);
            /**
             * Verifacamos la conexion si falla envia un mensaje de servidor no encontrado.
             * Si la conexión da ok, accedemos a los datos
             */
            if (! $sock) {
                $message = [
                    'mensaje' => 'Servidor no encontrado',
                    'servidor' => $domain,
                ];
            } else {
                /**
                 * El método fwrite() escribe el contenido del dominio apuntado por el sokect
                 *  que devuelve un puntero al fichero.
                 */
                fwrite($sock, $domain."\r\n");
                //ejecutamos un while hasta que llegue al final del archivo
                while (! feof($sock)) {
                    //El método fgets recupera las líneas desde el puntero al fichero.
                    $infomacion[] = fgets($sock, 128);
                }
                // Cierra la conexión al sockect de Internet.
                fclose($sock);
            }
            // Defino un array donde voy a guardar los NameServer
            $serverName = [];
            for ($i = 0; $i < count($infomacion); $i++) {
                if (str_contains($infomacion[$i], 'Name Server')) {
                    $serverName[] = $infomacion[$i];
                }
            }
            $message = $serverName;
        } else {
            $message = [
                'message' => 'El dominio ingresado no esta habilitado o no termina en .com',
                'domain' => $domain,
            ];
        }

        return response()->json($message);
    }
}
