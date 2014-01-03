#ifndef LABELCLASS_H
#define LABELCLASS_H

#include <QObject>
#include <QMetaType>

class LabelClass : public QObject
{
    Q_OBJECT

    Q_PROPERTY(QString msg READ getMsg WRITE setm_msg NOTIFY m_msgChanged)

public :
    LabelClass();
    virtual ~LabelClass();

    QString getMsg();

void setm_msg(QString);

public slots:

    //void run();

   signals:

    void m_msgChanged(QString);

private :
    QString m_msg;

};

#endif // LABELCLASS_H
