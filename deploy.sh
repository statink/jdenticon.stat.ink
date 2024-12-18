#!/bin/bash

set -ue

BASE_VERSION="3.0"

GIT_COMMIT_DATE=$(git log --date=iso --pretty=format:"%cd" -n 1)
VERSION_DATE=$(date --utc --date="$GIT_COMMIT_DATE" '+%Y%m%d.%H%M%S')
VERSION_TAG="v${BASE_VERSION}.${VERSION_DATE}"

make vendor

git tag -m $VERSION_TAG $VERSION_TAG || /bin/true
git push origin master $VERSION_TAG

vendor/bin/dep deploy --tag="$VERSION_TAG"
