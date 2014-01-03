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
