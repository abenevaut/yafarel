# This is a sample Dockerfile for a YAF production application

FROM abenevaut/yaf-framework:php81

LABEL maintainer="<Your name & email>"

#
# Install your application dependencies here
#

# when you copy, assure that vendor/bundle (ruby stuff) is not present
# when you copy, assure that node_modules (node stuff) is not present
COPY . /var/task
