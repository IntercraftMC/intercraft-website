#!/usr/bin/python3

import os
import shutil
import sys

# Where the showcase images are
PATH = "./public/img/showcase/"

# Remove the existing directory
shutil.rmtree(PATH)

# Create the directory
os.mkdir(PATH)

# Copy over the example image to the locations
for i in range(12):
    os.mkdir(PATH + str(i+1))
    for j in range(15):
        shutil.copy("./resources/img/example.png", PATH + str(i+1) + '/' + str(i*15 + j + 1) + ".png")
        shutil.copy("./resources/img/example_thumb.png", PATH + str(i+1) + '/' + str(i*15 + j + 1) + "_thumb.png")
