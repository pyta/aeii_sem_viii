#ifndef MYCLASS_H
#define MYCLASS_H

#include <QGuiApplication>
#include <QQuickView>
#include <QDebug>
//#include <QObject>
#include <QQuickItem>
#include <QQmlEngine>
#include <QQmlComponent>


#include "sailfishapplication.h"

#include "client.h"
#include "server.h"

class MyClass : public QObject
{

     Client c;
     //Server s;

    Q_OBJECT
public slots:
    void cppSlot(const QString &msg)
    {
        qDebug() << "Called the C++ slot with message:" << msg;
            c.connectToServer();

             printf("Send  1 \n");
    }

    void cppDisconect (const QString &msg)
    {

        //----------------
        //QDeclarativeEngine engine;
        //QDeclarativeComponent component(&engine,"main.qml");
        //QObject * obj = component.create();

       // QDeclarativeContext *windowContext = new QDeclarativeContext(engine.rootContext());
        //QVariant textProperty = obj->property("text");

        //-------------
        //QScopedPointer<QQuickView> view(Sailfish::createView("main.qml"));
        //QObject *itemButton = view->findChild<QObject*>("txtSend");

       // QVariant textToSend = itemButton->("text");\

         printf("Send 2 GO \n");
        c.Send(msg);
        //s.listen();
    }

    void cppStartServer(const QString &msg)
    {
        printf("Listen GO");
        //s.listen();
    }
};

#endif // MYCLASS_H
