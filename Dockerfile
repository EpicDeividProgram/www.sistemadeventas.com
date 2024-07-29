FROM ubuntu:latest
LABEL authors="DAMG"

ENTRYPOINT ["top", "-b"]