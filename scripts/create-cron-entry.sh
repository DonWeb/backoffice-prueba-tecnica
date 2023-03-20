#!/bin/bash

SCRIPT_BACKUP="$PWD/make-db-backup.sh"

(crontab -l; echo "0 0 * * * $SCRIPT_BACKUP") | sort -u | crontab -u $USER -