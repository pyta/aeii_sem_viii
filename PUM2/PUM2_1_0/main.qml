import QtQuick 2.0
import Sailfish.Silica 1.0
import "pages"


ApplicationWindow
{
    //initialPage: FirstPage { }
    id: pol

    signal qmlSignal(string msg)
    signal qmlSignalDisconnect (string msg)
    signal qmlSignalServer (string msg)


    Button
    {

        signal qmlSignal(string msg)
        id: item2
        objectName: "item2"
        text: "Connect"
        width: 100; height: 100

        MouseArea {
            anchors.fill: parent
            onClicked: pol.qmlSignal("Hello from QML")
        }
    }
    Button
    {

        signal qmlSignal(string msg)
        id: item3
        objectName: "item3"
        text: "Connect"
        width: 100; height: 100
        x: 100
        y: 200

        MouseArea {
            anchors.fill: parent
            onClicked: pol.qmlSignal(txt1.text)
        }
    }

    Button
    {

        signal qmlSignal(string msg)
        id: item4
        objectName: "item4"
        text: "Start Server"
        width: 100; height: 100
        x: 100
        y: 300

        MouseArea {
            anchors.fill: parent
            onClicked: pol.qmlSignal(txt1.text)
        }
    }

    TextInput
    {
        id: txt1
        objectName: "txtSend"
        scale: 2.0
        x:100
        y:600
        text: "Wyslij"
        color: "white"
    }

    Text
    {
        id:txt2
        objectName: "lblMsg"
        scale: 2.0
        x:300
        y:600
        text : LabelClass.msg
        color: "white"
    }



 //To jest nie potrzebne. Jak sie kliknie gdziekolwiek to wysyla komunikat.
   /* MouseArea {
        anchors.fill: parent
        onClicked: pol.qmlSignal("Hello from QML")
    }
*/

    cover: Qt.resolvedUrl("cover/CoverPage.qml")
}


