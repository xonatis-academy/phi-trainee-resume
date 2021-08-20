import requests

response = requests.post('http://localhost:8000/api/login', json={
    'username' : 'hello@hello.com',
    'password': 'hellohello'
})
print(response)
print(response.json())