record_command="php artisan make:area-record"
period=60
while [ 1 == 1 ]; do
    now=$(date +"%T")
    echo "updated at $now";
    $record_command;
    sleep $period;
done

