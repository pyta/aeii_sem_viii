#include "server.h"
#include <QTcpServer>
#include <QTcpSocket>
#include <cstdio>
#include <HelloThread.h>

Server::Server(QObject *parent, LabelClass * lbl) :
    QObject(parent)
{
    server = new QTcpServer(this);
    connect(server, SIGNAL(newConnection()),
            this, SLOT(on_newConnection()));

    labelMsg = lbl;
}

void Server::listen()
{

    emit getMessage("Listen Server \n");
    labelMsg->setm_msg("Listen Server");
    server->listen(QHostAddress("10.0.2.15"), 10018);
     printf("KOSA");
}

void Server::on_newConnection()
{
    socket = server->nextPendingConnection();
    if(socket->state() == QTcpSocket::ConnectedState)
    {
        printf("New connection established.\n");
    }
    else
        printf ("Something Wrong");

    connect(socket, SIGNAL(disconnected()),
            this, SLOT(on_disconnected()));
    connect(socket, SIGNAL(readyRead()),
            this, SLOT(on_readyRead()));
}

void Server::on_readyRead()
{
    while(socket->canReadLine())
    {
        QByteArray ba = socket->readLine();
        if(strcmp(ba.constData(), "!exit\n") == 0)
        {
            socket->disconnectFromHost();
            break;
        }
        printf(">> %s", ba.constData());
        labelMsg->setm_msg(ba.constData());
        emit this->getMessage("text");
    }

}

void Server::on_disconnected()
{
    printf("Connection disconnected.\n");
    disconnect(socket, SIGNAL(disconnected()));
    disconnect(socket, SIGNAL(readyRead()));
    socket->deleteLater();
}
