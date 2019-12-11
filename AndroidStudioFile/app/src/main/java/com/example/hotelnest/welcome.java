package com.example.hotelnest;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.widget.ImageView;

public class welcome extends AppCompatActivity {
    private SharedPreferences preferences;
    private ImageView welcomeIv = null;//欢迎图片控件
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
        welcomeIv = (ImageView) this.findViewById(R.id.iv_welcome);
        preferences = getSharedPreferences("Wodget", MODE_PRIVATE);
        //软件开启动画延迟
        AlphaAnimation anima = new AlphaAnimation(0.3f, 1.0f);
        anima.setDuration(1000);// 设置动画显示时间
        welcomeIv.startAnimation(anima);
        anima.setAnimationListener(new AnimationImpl());
    }
    private class AnimationImpl implements Animation.AnimationListener {

        @Override
        public void onAnimationStart(Animation animation) {
            welcomeIv.setBackgroundResource(R.drawable.welcome_img);

        }

        @Override
        public void onAnimationEnd(Animation animation) {
            skip(); // 动画结束后跳转到别的页面
        }

        @Override
        public void onAnimationRepeat(Animation animation) {

        }

    }
    private void skip() {
        int count = preferences.getInt("count", 0);
        //如果在本地数据库中检测出没有登录信息则跳转至登录界面，否则进入首页
        Intent intent = new Intent();
        if (count == 0) {
            intent.setClass(welcome.this, MainActivity.class);
        }else {
            intent.setClass(welcome.this, home_activity.class);
        }
        startActivity(intent);
        finish();
    }
}
