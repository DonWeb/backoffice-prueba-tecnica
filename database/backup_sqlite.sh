#!/bin/bash

FINAL_OUTPUT=backup/`date +%Y-%m-%d`_$DATABASE.sqlite
sqlite3 database.sqlite ".backup $FINAL_OUTPUT"
gzip $FINAL_OUTPUT