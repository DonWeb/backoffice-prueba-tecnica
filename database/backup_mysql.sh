#!/bin/bash

USER="usuario"
PASSWORD="123456"
DATABASE="my_db"
FINAL_OUTPUT=backup/`date +%Y-%m-%d`_$DATABASE.sql

mysqldump --user=$USER --password=$PASSWORD $DATABASE > $FINAL_OUTPUT
gzip $FINAL_OUTPUT