package com.shoppinglist2.app;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.protocol.BasicHttpContext;
import org.apache.http.protocol.HTTP;
import org.apache.http.protocol.HttpContext;
import org.apache.http.util.EntityUtils;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.URL;
import java.nio.charset.Charset;
import java.util.ArrayList;
import java.util.List;


public class MainActivity extends Activity {

    List<Product> products = new ArrayList<Product>();
    ListView productsListView;
    Button btnLoad;
    EditText myIdEdit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        productsListView = (ListView) findViewById(R.id.products_list_view);
        btnLoad = (Button) findViewById(R.id.btnLoadList);
        myIdEdit = (EditText) findViewById(R.id.tbGetId);

        btnLoad.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                products.clear();
                new ListLoader().execute();
            }
        });
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void populateList () {
        ArrayAdapter<Product> adapter = new ProductArrayAdapter(MainActivity.this, products);
        productsListView.setAdapter(adapter);
    }

    public String text = "";
    public class ListLoader extends AsyncTask<String, Void, String> {

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            List<Product> tmpList = MyParser.parseToListOfProducts(result);

            for (Product product : tmpList)
            {
                products.add(product);
            }

            populateList();
        }

        @Override
        protected String doInBackground(String... url) {
            String result = "";

            try {
                HttpClient httpClient = new DefaultHttpClient();
                HttpContext localContext = new BasicHttpContext();
                HttpGet httpGet = new HttpGet(
                        "http://shopping.devspot.pl/?id="+myIdEdit.getText());
                HttpResponse response = httpClient.execute(httpGet,
                        localContext);

                BufferedReader reader = new BufferedReader(
                        new InputStreamReader(response.getEntity().getContent()));

                String line = null;
                while ((line = reader.readLine()) != null) {
                    result += line;
                }

            } catch (Exception e) {

            }
            return result;
        }


    }

}
