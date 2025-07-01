"use client";
import React, { useState } from "react";
import LoginForm from "./components/LoginForm";
import ResetPasswordForm from "./components/ResetPasswordForm";
import SignupForm from "./components/SignupForm";
import { Header } from "./components/Header";// Make sure the path is correct

function LoginPage() {
  const [showReset, setShowReset] = useState(false);
  const [showSignup, setShowSignup] = useState(false);

  return (
    <div className="min-h-screen bg-[#11849B] flex flex-col">
      <Header onSignUpClick={() => setShowSignup(true)} />

      <main className="flex flex-1 items-center justify-center px-4">
        <div className="bg-black text-white p-8 rounded-2xl shadow-md w-full max-w-md">
          <h2 className="text-2xl font-bold mb-6 text-center">
            {showSignup ? "Create an Account" : "Patient Login Portal"}
          </h2>

          {showSignup ? (
            <SignupForm />
          ) : (
            <LoginForm onForgotPassword={() => setShowReset(true)} />
          )}

          <button
            className="mt-4 text-sm text-blue-400 hover:underline"
            onClick={() => setShowSignup(!showSignup)}
          >
            {showSignup ? "Back to Login" : "Don't have an account? Sign Up"}
          </button>
        </div>
      </main>

      {showReset && <ResetPasswordForm onCancel={() => setShowReset(false)} />}
    </div>
  );
}

export default LoginPage;
