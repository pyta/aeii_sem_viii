#ifndef SERVER_H
#define SERVER_H

#include <QObject>
#include <LabelClass.h>

class QTcpServer;
class QTcpSocket;

class Server : public QObject
{
    Q_OBJECT
public:
    explicit Server(QObject *parent = 0, LabelClass * lbl=0);
    void listen();
signals:
    void getMessage(QString);
public slots:
    void on_newConnection();
    void on_readyRead();
    void on_disconnected();
private:
    QTcpServer* server;
    QTcpSocket* socket;
    LabelClass * labelMsg;

};

#endif // SERVER_H
