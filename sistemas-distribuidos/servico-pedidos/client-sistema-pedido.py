import requests
import json

url = "http://localhost:8000/api/cardapio"

print('GET cardapio...\n')
r = requests.get(url = url)

dataCardapio = r.json()

def printCardapio():
    print('\n#Cardápio:')
    for i in dataCardapio:
        print("{id} - {nome} - {preco}".format(
            id = i['id'],
            nome = i['nome'],
            preco= i['preco']))
    
def buscar(id):
    for i in dataCardapio:
        if i['id'] == id:
            return i

def escolher(id, quantidade):
    item = buscar(int(id))
    
    if item and int(quantidade) > 0:
        dataPost['items'].append({'id': id, 'quantidade': quantidade})
        return True
    return False


while True:
    printCardapio();
    dataPost = {'items': []}
    escolhendo = True

    while escolhendo:
        print('\n#Novo Pedido:')
        id = input('Digite o id do lanche: ')
        quantidade = input('Digite a quantidade: ')

        res = escolher(id, quantidade)

        if res:
            condicao = input('Continuar escolhendo [n para parar]? ')
            if condicao == 'n':
                escolhendo = False
        else:
            print('Entrada de item inválida')

    url = "http://localhost:8000/api/pedidos"
    headers = {'content-type': 'application/json'}

    print('POST Pedido...\n')
    r = requests.post(url = url, data=json.dumps(dataPost), headers = headers)
    data = r.json()

    print("Pedido Id: {}\nTotal: {}\nCriado em: {}".format(
        data['id'],
        data['total'],
        data['created_at']))
