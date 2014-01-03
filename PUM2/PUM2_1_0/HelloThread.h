#ifndef HELLOTHREAD_H
#define HELLOTHREAD_H

#include "QThread"
#include "server.h"

class HelloThread : public QThread
{
    Q_OBJECT
signals:
    void sendMsg(QString msg);
private:
    void run();
    QString lastMsg;

public:
    explicit HelloThread(Server &serv );
    Server *s;
private slots :
    void msgHit(QString);
};

#endif // HELLOTHREAD_H
