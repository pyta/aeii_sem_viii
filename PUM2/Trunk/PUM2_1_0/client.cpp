#include "client.h"
#include <QTcpSocket>
#include <QHostAddress>
#include <cstdio>

Client::Client(QObject *parent) :
    QObject(parent)
{
    socket = new QTcpSocket(this);
    connect(socket, SIGNAL(connected()),
            this, SLOT(on_connected()));
}

void Client::on_connected()
{
    printf("Connection established.\n");
    char buffer[1024];
    forever
    {
        printf(">> ");
        gets(buffer);
        int len = strlen(buffer);
        buffer[len] = '\n';
        buffer[len+1] = '\0';
        socket->write(buffer);
        socket->flush();
    }

}

void Client::connectToServer()
{
    socket->connectToHost(QHostAddress("10.0.2.2"), 10019);
}
