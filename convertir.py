import os
import sys
import subprocess

ruta_entrada=sys.argv[1] #ruta entrada F:\pistas

targets=['.dat', '.avi', '.mpg', '.wmv']
errores=[]
def convert_to_mp4(archivo_in, archivo_out):
  command = ['ffmpeg.exe', '-i', archivo_in, archivo_out]
  subprocess.run(command)
  if not os.path.isfile(archivo_out):
    errores.append(archivo_in)
  else:
    print('Archivo convertido a mp4:', archivo_out)


cantidad=0
for target in targets:
  print(f'\n\nCONVERTIR ARCHIVOS {target} a MP4\n')
  for current, carpetas, archivos in os.walk(ruta_entrada):
    for archivo in archivos:
      if archivo.endswith(target) or archivo.endswith(target.upper()):
        cantidad+=1
        entrada=os.path.join(current, archivo)
        salida=os.path.join(current, archivo).replace(target, '.mp4')
        salida=salida.replace(target.upper(), '.mp4')
        convert_to_mp4(entrada, salida)

print(f'Archivos localizados {cantidad}\nArchivos convertidos {cantidad - len(errores)}\n\nERRORES: ')
for error in errores:
  print('Error al convertir:', error)