import subprocess

# if the script don't need output.
subprocess.call("php server\\artisan serve")

# if you want output
#proc = subprocess.Popen("php sistema-pedido\\artisan serve", shell=True, stdout=subprocess.PIPE)
#script_response = proc.stdout.read()

#print(proc)
