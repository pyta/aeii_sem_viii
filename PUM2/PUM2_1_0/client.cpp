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
    printf("Connect GO \n");
    char buffer[100] = "Connect\n\0";
    //forever
    //{
        printf(">> ");
        //gets(buffer);
        //int len = strlen(buffer);
        //buffer[len] = '\n';
        //buffer[len+1] = '\0';
        socket->write(buffer);
        //socket->flush();
    //}

}

void Client::Send(QString sendText)
{
    sendText += "\n\0";
    const char *str;
    QByteArray ba;
    ba = sendText.toLatin1();
    str = ba.data();
    //char buffer[100] ;

    //memccpy(buffer,sendText.)
    //int len = strlen(buffer);
    //buffer[len] = '\n';
    //buffer[len+1] = '\0';
    socket->write(str);
   // socket->flush();
}

void Client::connectToServer()
{
    socket->connectToHost(QHostAddress("10.0.2.2"), 10019);
}
