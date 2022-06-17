import cv2
from pyzbar.pyzbar import decode
import time
import mysql.connector
import warnings
import pyfirmata
board = pyfirmata.Arduino('COM3')
RedPin = 7
GreenPin = 8

warnings.filterwarnings("ignore")
db=mysql.connector.connect(host="localhost",user="root",password="",database="iot")
cursor=db.cursor()
cap = cv2.VideoCapture(0)
cap.set(3, 640)
cap.set(4,480)
camera = True
while camera == True:
	success, frame = cap.read()
	for check in decode(frame):
		am = check.data.decode('utf-8')
		iam= int(am)
		query="SELECT StudentNum, Name FROM login WHERE StudentNum="+ am + " && Status='Approved';"
		cursor.execute(query)
		rows=cursor.fetchall()
		flag=False
		for row in rows:
			flag=True
			print('Μπορειτε να περασετε')
			mycursor = db.cursor()
			sql = "INSERT INTO attendance (StudentNum) VALUES (" + am + ");"
			mycursor.execute(sql)
			db.commit()
			print(mycursor.rowcount, "record inserted.")
			board.digital[GreenPin].write(1)
			time.sleep(4)
			board.digital[GreenPin].write(0)
			time.sleep(0.5)    
		if flag == False:
			print('Δεν εχετε δικαιωμα να περασετε')
			board.digital[RedPin].write(1)
			time.sleep(4)
			board.digital[RedPin].write(0)
			time.sleep(0.5)
		print("Αριθμός Μητρώου:",am)
		time.sleep(2)
	cv2.imshow('Testing-code-scan',frame)
	cv2.waitKey(1)
