import 'package:flutter/material.dart';

class SolusiPage extends StatefulWidget {
  List<Map<String, dynamic>> solusiList;
  SolusiPage(this.solusiList);
  @override
  _SolusiPageState createState() => _SolusiPageState();
}

class _SolusiPageState extends State<SolusiPage> {
  Widget mapLocation(String solusi, String ket, BuildContext context) {
    return Card(
      child: ListTile(
        title: Container(child: Text(solusi)),
        onTap: () {
          showSlideupView(solusi, ket, context);
        },
      ),
    );
  }

  void showSlideupView(String solusi, String ket, BuildContext context) {
    double widthMax = MediaQuery.of(context).size.width;
    showBottomSheet(
        context: context,
        builder: (context) {
          return new Container(
            height: 200,
            width: widthMax,
            color: Colors.blue,
            child: new GestureDetector(
              onTap: () => Navigator.pop(context),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Text(
                    solusi,
                    style: TextStyle(
                        decoration: TextDecoration.underline,
                        fontWeight: FontWeight.bold,
                        fontSize: 30,
                        color: Colors.white),
                  ),
                  Text(
                    "Keterangan: ${ket}",
                    style: TextStyle(
                        fontSize: 20,
                        color: Colors.white),
                  ),
                  
                ],
              ),
            ),
          );
        });
  }


  int numb = 0;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Halaman Solusi"),
      ),
      body: Container(
        child: ListView.builder(
          itemCount: widget.solusiList.length,
          itemBuilder: (BuildContext context, int index) {
            return mapLocation(widget.solusiList[index]['solusi'].toString(),
                widget.solusiList[index]['ket'].toString(), context);
          },
        ),
      ),
    );
  }
}

// ListView(
//           children: <Widget>[
//             SizedBox(
//               height: 30,
//             ),
//             Center(
//               child: Text(
//                 "Solusi Kondisi",
//                 style: TextStyle(
//                   decoration: TextDecoration.underline,
//                   fontSize: 30,
//                   fontWeight: FontWeight.bold,
//                 ),
//               ),
//             ),
//             SizedBox(
//               height: 30,
//             ),
//             for (var i in widget.solusiList)
//               Text(
//                 "${numb = numb + 1}. ${i['solusi'].toString()} \n   ${i['ket'].toString()}",
//                 style: TextStyle(fontSize: 20),
//               )
//           ],
//         ),
//       ),
