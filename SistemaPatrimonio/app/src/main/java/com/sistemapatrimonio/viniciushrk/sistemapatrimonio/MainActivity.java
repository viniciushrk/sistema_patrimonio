package com.sistemapatrimonio.viniciushrk.sistemapatrimonio;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    private Button entrar;
   /* private EditText senha;*/
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
       /* senha = (EditText) findViewById(R.id.editText);*/

        entrar = (Button) findViewById(R.id.button);
        entrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, menu.class));
            }
        });
       /* entrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, menu.class));
                *//*String senhaUser = senha.getText().toString();
                if(senhaUser.isEmpty()){
                    Toast.makeText(getApplicationContext(),"digite a senha",Toast.LENGTH_LONG).show();
                }else{

                        startActivity(new Intent(MainActivity.this, menu.class));

                        Toast.makeText(getApplicationContext(),"erro",Toast.LENGTH_LONG).show();

                }*//*

            }
        });*/

    }
}
