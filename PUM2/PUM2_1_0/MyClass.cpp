
#include <QGuiApplication>
#include <QQuickView>
#include <QDebug>
#include <QObject>
#include <QQuickItem>


#include "client.h"

class MyClass : public QObject
{
    Q_OBJECT
public slots:
    void cppSlot(const QString &msg)
    {
        qDebug() << "Called the C++ slot with message:" << msg;

        Client c;
        c.connectToServer();

    }
};
