package com.shoppinglist2.app;

import android.app.Activity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.CheckBox;
import android.widget.TextView;

import java.lang.reflect.Array;
import java.util.List;

/**
 * Created by WolfGD on 6/1/2014.
 */
 
 //posredniczy miedzy UI, a warstwa logiki
public class ProductArrayAdapter extends ArrayAdapter<Product> {
    private Activity activity;
    private List<Product> products;

    public ProductArrayAdapter(Activity activity, List<Product> products) {
        super(activity, R.layout.list_item, products);
        this.products = products;
        this.activity = activity;
    }

    @Override
    public View getView (int position, View view, ViewGroup parent) {
        if (view == null)
            view = activity.getLayoutInflater().inflate(R.layout.list_item, parent, false);

        Product currentProduct = products.get(position);

        TextView name = (TextView) view.findViewById(R.id.product_name);
        name.setText(currentProduct.getName());

        CheckBox checked = (CheckBox) view.findViewById(R.id.product_check);
        checked.setChecked(currentProduct.getChecked());

        return view;
    }
}
