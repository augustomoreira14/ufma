from socket import *
import json

MAX_PACKET = 4096

def normalize_line_endings(s):

    return ''.join((line + '\n') for line in s.splitlines())
    
def handleRequest(connection, method, uri, data):
    if method == 'GET':
        if uri == '/':
            sendResponse(connection, 404, 'API')
            return True
        if uri == '/menu':
            return requestMenu(connection)
            
    if method == 'POST':
        if uri == '/order':
            return createOrder(connection, data)

    sendResponse(connection, 404, '')
        

def requestMenu(connection):
    data = [
        {'id': 1, 'name': 'Item 1', 'price': 10.5},
        {'id': 2, 'name': 'Item 2', 'price': 4.5},
        {'id': 3, 'name': 'Item 3', 'price': 5.0},
    ]

    sendResponse(connection, 200, data)

def createOrder(connection, data):
    return ''

def sendResponse(connection, status, content):
    
    response_body_raw = json.dumps(content)
        
    response_headers = {
        'Content-Type': "application/json",
        'Content-Length': len(response_body_raw),
        'Connection': 'close',
        'Cache-Control': 'no-cache, private'
    }

    response_headers_raw = ''
    for i in response_headers:
        response_headers_raw += '{}: {}\n'.format(i, response_headers[i])

    header = "HTTP/1.1 {} {}\n".format(status, getMessageStatus(status))
    
    connection.sendall(header.encode('utf-8'))
    connection.sendall(response_headers_raw.encode('utf-8'))
    connection.sendall("\n".encode())
    connection.sendall(response_body_raw.encode('utf-8'))
    
def getMessageStatus(code):
    if code == 404:
        return 'Not Found'
    else:
        return 'OK'

host = 'localhost'
port = 9000

socketObj = socket(AF_INET, SOCK_STREAM)

socketObj.bind((host,port))

socketObj.listen(5)

while True:
    connection, address = socketObj.accept()

    data = connection.recv(MAX_PACKET)

    print(data)
    
    request = normalize_line_endings(data.decode("utf-8"))
    request_head, request_body = request.split('\n\n', 1)

    request_head = request_head.splitlines()
    request_headline = request_head[0]
    request_headers = dict(x.split(': ', 1) for x in request_head[1:])

    request_method, request_uri, request_proto = request_headline.split(' ', 3)

    handleRequest(connection, request_method, request_uri, request_body)
        
    connection.close()
        
