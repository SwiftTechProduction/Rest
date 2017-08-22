using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.IO;
using Newtonsoft.Json.Linq;
using Newtonsoft.Json;

namespace Client_CSharp
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            string URI = "http://localhost/pbp/rest/Server_PHP/mahasiswa";
            HttpWebRequest request = (HttpWebRequest)HttpWebRequest.Create(URI);
            request.Method = "GET";
            String json = String.Empty;
            using (HttpWebResponse response = (HttpWebResponse)request.GetResponse())
            {
                Stream dataStream = response.GetResponseStream();
                StreamReader reader = new StreamReader(dataStream);
                json = reader.ReadToEnd();
                reader.Close();
                dataStream.Close();
            }
            
            // parse JSON object
            String hasil="";
            dynamic results = JsonConvert.DeserializeObject<dynamic>(json);
            foreach (var mhs in results)
            {
                hasil += mhs.nim + " - ";
                hasil += mhs.nama + " - ";
                hasil += mhs.progdi + Environment.NewLine;
            }
            textBox1.Text = hasil;
        }
    }
}
