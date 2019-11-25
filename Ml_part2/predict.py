import numpy as np
import cv2
from create_feature import *
from calorie_calc import *
import csv

def predict(img_path):
	svm_model = cv2.SVM()
	svm_model.load('svm_data.dat')
	feature_mat = []
	response = []
	image_names = []
	pix_cm = []
	fruit_contours = []
	fruit_areas = []
	fruit_volumes = []
	fruit_mass = []
	fruit_calories = []
	skin_areas = []
	fruit_calories_100grams = []
	#print("till here")
	fea, farea, skinarea, fcont, pix_to_cm = readFeatureImg(img_path)
	pix_cm.append(pix_to_cm)
	fruit_contours.append(fcont)
	fruit_areas.append(farea)
	feature_mat.append(fea)
	skin_areas.append(skinarea)
	image_names.append(img_path)

	testData = np.float32(feature_mat).reshape(-1,94)
	responses = np.float32(response)
	
	result = svm_model.predict_all(testData)
	
	#print(result)
	for i in range(0, len(result)):

		volume = getVolume(result[i], fruit_areas[i], skin_areas[i], pix_cm[i], fruit_contours[i])
		
		mass, cal, cal_100 = getCalorie(result[i], volume)
		
		fruit_volumes.append(volume)
		fruit_calories.append(cal)
		fruit_calories_100grams.append(cal_100)
		fruit_mass.append(mass)
	return fruit_calories

if __name__ == '__main__':
	req = predict('tmp.jpg')
	fp = open("calories.txt","w")
	fp.write(str(req[0]))
	print(req[0])