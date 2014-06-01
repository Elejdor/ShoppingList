package com.shoppinglist2.app;

import android.os.Debug;
import android.util.Log;

import java.util.ArrayList;
import java.util.StringTokenizer;

/**
 * Created by WolfGD on 6/1/2014.
 */
public class Product {
    private String name;
    private boolean checked;

    public Product(String name, boolean checked) {
        init(name, checked);
    }

    public Product(String name) {
        init(name, false);
    }

    private void init(String name, boolean bought) {
        this.name = name;
        this.checked = bought;
    }

    public String getName() {
        return name;
    }

    public boolean getChecked() {
        return checked;
    }

    public static Product tryParse(String text) {
        String[] values = MyParser.split(text, "|");
        if (values.length != 2)
            return new Product("wrong number of vals: " + values.length + ", " + values[0], false);

        String sTrue = "1";
        String sFalse = "0";

        if (!(values[1].equals(sTrue) || values[1].equals(sFalse)))
            return new Product("wrong bool: " + values[1], false);

        String name = values[0];
        boolean checked = (values[1].equals(sTrue));
        return new Product(name, checked);
    }

}
