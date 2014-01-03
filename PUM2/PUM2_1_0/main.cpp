
#include <QGuiApplication>
#include <QQuickView>
#include <QDebug>
//#include <QObject>
#include <QQuickItem>
#include <QQmlEngine>
#include <QQmlComponent>
#include <QQmlContext>



#include "sailfishapplication.h"
#include "client.h"
#include "MyClass.h"
#include "Message.h"
#include "server.h"
#include <QThread>
#include "HelloThread.h"
#include <LabelClass.h>



Q_DECL_EXPORT int main(int argc, char *argv[])
{


    QScopedPointer<QGuiApplication> app(Sailfish::createApplication(argc, argv));
    QScopedPointer<QQuickView> view(Sailfish::createView("main.qml"));
    //------------------

    LabelClass * lblC = new LabelClass();

   // QQmlEngine engine;
    //QStringListModel modelData;
    //QQmlContext *context = new QQmlContext(engine.rootContext());
    //context->setContextProperty("LabelClass", &lblC);
    //Potrzebne zeby powiazac labela z obiektem tej klasy co zmieniamy w niej message.
    view->rootContext()->setContextProperty("LabelClass",lblC);


     //qDebug() << "hello from GUI thread " << app.thread()->currentThreadId();
     //thread.wait();  // do not exit before the thread is completed!

    //Serwer - tutaj bo inaczej cos nie chce dzialac, jako parametr ma powiazana klase labela z interfejsem
    Server * s = new Server(0,lblC);

    //--------------------
    //Oniekt mojej klasy ktora ma metodki ktore maja byc wywloywane po klikniecu na guzik.
    MyClass myClass;
   // Server servMain;
    //HelloThread thread(servMain);
    // test
    lblC->setm_msg("asdas");
    //to wypada bo nie chialo sie powiazac dobrze z ta metoda wiec przekazuje wskaznik do labla do serwera
    QObject::connect(s, SIGNAL(getMessage(QString)),lblC, SLOT(LabelClass::setm_msg(QString)));
    //thread.start();
    //nasluchiwanie serwera - co dziwne nie blokuje UI
    s->listen();
    //--------------------
    //QScopedPointer<QQuickView> viewButton( Sailfish::createView("pages/FirstPage.qml"));
    //QQuickView viewButton( QUrl::fromLocalFile(Sailfish::deploymentPath() + "pages/FirstPage.qml"));
    QObject *itemButton = view->rootObject();//findChild<QObject*>("item2");

    //MyClass myClass;
    QObject::connect(itemButton, SIGNAL(qmlSignal(QString)),&myClass, SLOT(cppSlot(QString)));
    QObject::connect(itemButton, SIGNAL(qmlSignal(QString)), &myClass,SLOT(cppDisconect(QString)));
    //QObject::connect(itemButton, SIGNAL(qmlSignal(QString)), &myClass,SLOT(cppStartServer()(QString)));

    //QObject::connect(itemButton, SIGNAL(qmlSignal(QString)), &myClass,SLOT(cppDisconect(QString)));

    //------------------

    //Sailfish::showView(view.data());
    //Sailfish::showView(viewButton.data());

    //Client c;
    //c.connectToServer();
    //--------------------------

    //QQmlEngine engine;
    //Message msg;
    //engine.rootContext()->setContextProperty("msg", &msg);
    //----------------------

    //Odpala widok, aktualnie tlyko jeden page ten glowny zostal - z reszta te rzeczy nie chcialy wpsolpracowac
     Sailfish::showView(view.data());

     //HelloThread thread;
     //thread.start();

    return app->exec();
}



