#!/bin/bash

pushd `dirname $0` > /dev/null
DIR=`pwd -P`
popd > /dev/null

echo "Watching sass files..."

sass --watch $DIR/resources/sass:$DIR/public/assets/css
