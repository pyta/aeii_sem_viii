
#ifndef SAILFISHAPPLICATION_H
#define SAILFISHAPPLICATION_H

class QString;
class QGuiApplication;
class QQuickView;

namespace Sailfish {

QGuiApplication *createApplication(int &argc, char **argv);
QQuickView *createView(const QString &);
QQuickView *createView();
void setView(QQuickView* view, const QString &);
void showView(QQuickView* view);
QString deploymentPath();
QString deploymentRoot();
}

#endif // SAILFISHAPPLICATION_H

