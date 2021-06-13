## About project

This project made as an assignment for employment in Teknasyon company I made in this project the api + callback +
reporting part

I will write the curl request i used in each endpoint

- Register:
  `curl -X POST \
  http://127.0.0.1:8000/api/device/register \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: a0147c71-13a2-b43b-a14b-4b8d1b59a971' \
  -d '{
  "uid": "280832ca-ab48-420c-8c5b-3d02de885345",
  "appId": "715",
  "language": "english",
  "os": "ios"
  }'`

  output:
  `{
  "status": "ok",
  "clientToken": "03c78a06-d556-4f1d-9049-a5939b1d6603"
  }`

- Purchase:
  `curl -X POST \
  http://127.0.0.1:8000/api/device/purchase \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: 7bf1a282-0275-467f-e5cd-01e179bccd6e' \
  -d '{
  "clientToken": "832982f9-fa93-42ed-9a54-a2115d854e19",
  "receipt": "291742811517885928984685894922203068843"
  }'`

  output:
  `{
  "status": true,
  "data": {
  "clientToken": "03c78a06-d556-4f1d-9049-a5939b1d6603",
  "receipt": "291742811517885928984685894922203068843",
  "expireDate": {
  "date": "2021-07-13 18:05:00.000000",
  "timezone_type": 3,
  "timezone": "UTC"
  },
  "deviceId": 2 } }`

- Check Subscription:
  `curl -X POST \
  http://127.0.0.1:8000/api/device/check-subscription \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: c91e3e27-c37a-8a51-0c95-8cb1b129ec87' \
  -d '{
  "clientToken": "a831de83-0e51-4222-8413-848acd47a766"
  }'`

  output:
  `{
  "status": true,
  "data": {
  "deviceStatus": "renewed",
  "appId": "715",
  "uid": "280832ca-ab48-420c-8c5b-3d02de885345"
  } }`

for reporting, you can check this endpoint after adding some records
`curl -X GET \
'http://127.0.0.1:8000/api/report/get?appId=710&os=ios&startDate=01-06-2021&endDate=13-06-2021' \
-H 'cache-control: no-cache' \
-H 'postman-token: 9c6e7edd-3427-f009-04fc-fe6e19f38fb6'`

in here if you want you can pass any of the parameter queries you want none of the passed parameter is required.
