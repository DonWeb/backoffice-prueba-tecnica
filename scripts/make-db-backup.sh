#!/bin/bash

source ../.env
DATE=$(date +%F)
FILE="backup_$DATE.sql"

mysqldump -u $DB_USERNAME -h localhost -P $DB_PORT -p$DB_PASSWORD $DB_DATABASE > $FILE