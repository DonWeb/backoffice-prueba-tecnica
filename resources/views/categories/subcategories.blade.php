<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de categorías y subcategorías</title>
    <style>
        table, tr, td{
            border: solid 2px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <th>Nivel 1</th>
            <th>Nivel 2</th>
            <th>Nivel 3</th>
        </thead>

        <tbody>
            @foreach($categoriesAll as $categorie)
            <tr>
                <td>{{$categorie->Nivel1}}</td>
                <td>{{$categorie->Nivel2}}</td>
                <td>{{$categorie->Nivel3}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>