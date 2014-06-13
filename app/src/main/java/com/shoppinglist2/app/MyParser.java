package com.shoppinglist2.app;

import java.util.ArrayList;
import java.util.List;
import java.util.StringTokenizer;

/**
 * Created by WolfGD on 6/1/2014.
 */
public class MyParser {
	//ten skrypt parsuje odpowiedz servera http wg. okreslonej konwencji i zwraca wynik w postaci kolekcji
    public static ArrayList<Product> parseToListOfProducts(String text) {
        String[] lines = split(text, ";");
        ArrayList<Product> result = new ArrayList<Product>(lines.length);

        for (int i = 0; i < lines.length; i++) {
            result.add(Product.tryParse(lines[i]));
        }

        return result;
    }

    public static String[] split(String text, String delimiters) {
        StringTokenizer strTkn = new StringTokenizer(text, delimiters);

        ArrayList<String> tmpArray = new ArrayList<String>(text.length());

        while (strTkn.hasMoreTokens())
            tmpArray.add(strTkn.nextToken());

        return tmpArray.toArray(new String[0]);
    }
}
