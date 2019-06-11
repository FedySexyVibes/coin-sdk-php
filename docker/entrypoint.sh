#!/bin/bash

function doUpload {
    if expr "$VERSION" : '^[0-9][0-9]*\.[0-9][0-9]*\.[0-9][0-9]*$'  ; then
#        pipenv run python setup.py sdist
#        pipenv run twine upload dist/*
        echo "doUpload"
    else
        echo "****** Skipping version $VERSION for upload ******";
    fi
}

function doTest {
#    pipenv run python setup.py test
    echo "doTest"
}

case "$1" in
	  test)
        doTest
	      ;;
	  upload)
        doUpload
	      ;;
	  *)
        echo "ERROR: unknown command $1"
        exit 1
esac
