#include <LabelClass.h>
#include <QQuickView>
#include <sailfishapplication.h>


LabelClass ::LabelClass ()
{

}

LabelClass::~LabelClass()
{

}

QString LabelClass::getMsg()
{
    return m_msg;
}

void LabelClass::setm_msg(QString text)
{
    //QScopedPointer<QQuickView> view(Sailfish::createView("main.qml"));
    //LabelClass * lblC = new LabelClass();
    // lblC->setm_msg(text);
    m_msg = text;
    emit m_msgChanged(text);
}
