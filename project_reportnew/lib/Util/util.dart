import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';

class UtilAuth {
  static loading(context) {
    return showDialog(
        context: context,
        barrierDismissible: true,
        builder: (BuildContext context) {
          return Center(
            child: SpinKitChasingDots(
              color: Colors.blue,
              size: 80.0,
            ),
          );
        });
  }

  static failedPopupDialog(context, var texts) {
    Navigator.of(context, rootNavigator: true).pop();
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        // return Dialog(
        return AlertDialog(
          title: Text('Peringatan!'),
          content: Text(
            '$texts',
            style: TextStyle(color: Colors.black, fontSize: 14),
          ),
          actions: <Widget>[
            FlatButton(
              child: Text('Ok'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            )
          ],
        );
        // );
      },
    );
  }

  static pemberitahuanPop(context, var texts, Widget pages) {
    Navigator.of(context, rootNavigator: true).pop();
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        // return Dialog(
        return AlertDialog(
          title: Text('Pemberitahuan'),
          content: Text(
            '$texts',
            style: TextStyle(color: Colors.black, fontSize: 14),
          ),
          actions: <Widget>[
            FlatButton(
              child: Text('Ok'),
              onPressed: () {
                Navigator.pushAndRemoveUntil(
                  context,
                  MaterialPageRoute(builder: (context) => pages),
                  (Route<dynamic> route) => false,
                );
              },
            )
          ],
        );
        // );
      },
    );
  }
}
