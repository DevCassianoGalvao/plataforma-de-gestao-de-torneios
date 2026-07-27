# Backup and Restore

Back up MySQL with `mysqldump`, `public/uploads-public` and `storage/private` to off-host encrypted storage. Rotate daily/weekly/monthly copies and test restore in a disposable database. Verify archive checksums and never store credentials or backup archives in the repository. Restore database first, then public/private files with their original relative paths.
