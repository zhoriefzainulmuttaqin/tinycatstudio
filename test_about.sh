php artisan serve --port=8001 &
PID=$!
sleep 3
curl -s http://127.0.0.1:8001 | grep -i "About Us"
kill $PID
