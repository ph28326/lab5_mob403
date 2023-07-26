package com.ph28326.lab5_mob403;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class AddProductActivity extends AppCompatActivity {
    private EditText edtName, edtPrice, edtDescription;
    private Button btnAdd;
    String strName,strPrice,strDes;
    CreateNewProductTask newProductTask;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_product);
        edtName = (EditText)findViewById(R.id.edtProductName);
        edtPrice = (EditText)findViewById(R.id.edtProductPrice);
        edtDescription = (EditText)findViewById(R.id.edtProductDes);
        btnAdd = (Button)findViewById(R.id.btnAdd);
        newProductTask = new CreateNewProductTask(this);
        btnAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                strName = edtName.getText().toString();
                strPrice = edtPrice.getText().toString();
                strDes = edtDescription.getText().toString();

                if (strName.isEmpty()) {
                    edtName.setError("Name is required");
                    return;
                }

                if (strPrice.isEmpty()) {
                    edtPrice.setError("Price is required");
                    return;
                }

                if (strDes.isEmpty()) {
                    edtDescription.setError("Description is required");
                    return;
                }

                newProductTask.execute(strName, strPrice, strDes);
            }
        });
    }
}