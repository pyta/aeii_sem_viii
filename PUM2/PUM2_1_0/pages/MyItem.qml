// MyItem.qml
import QtQuick 2.0

Rectangle {
    id: item
    width: 300; height: 300


    signal qmlSignal(string msg)

    MouseArea {
        anchors.fill: parent
        onClicked: item.qmlSignal("Hello from QML")
    }
}
