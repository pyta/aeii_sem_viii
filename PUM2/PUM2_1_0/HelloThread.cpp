#include "server.h"
#include "HelloThread.h"
#include <cstdio>


 HelloThread::HelloThread (Server  &serv)
{
    s = &serv;
}

void HelloThread::run()
{
     //qDebug() << "hello from worker thread " << thread()->currentThreadId();
    //QObject::connect(&s, SIGNAL(s.getMessage(QString)),&this,SLOT(this->msgHit(QString)),Qt::DirectConnection);
    printf("Start S");
    s->listen();
   // HelloThread::s.listen();
}

void HelloThread::msgHit(QString)
{

//emit HelloThread::sendMsg("text");
}
