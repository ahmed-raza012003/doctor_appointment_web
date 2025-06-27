"use client";
import React from 'react';
import { useForm } from 'react-hook-form';

function LoginForm({ onForgotPassword }) {
    const { register, handleSubmit, reset, formState: { errors } } = useForm();

    const onSubmit = (data) => {
        console.log("Login Data:", data);
        reset();
    };

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
            <div>
                <label className="block font-medium mb-1">Email</label>
                <input
                    type="email"
                    placeholder="Enter your Email"
                    className="w-full px-4 py-2 border border-white rounded-md text-white placeholder-white bg-transparent"
                    {...register('email', {
                        required: 'Email is required',
                        pattern: {
                            value: /^\S+@\S+$/i,
                            message: 'Enter a valid email address',
                        },
                    })}
                />
                {errors.email && <p className="text-red-500 text-sm">{errors.email.message}</p>}
            </div>
            <div>
                <label className="block font-medium mb-1">Password</label>
                <input
                    type="password"
                    placeholder="Enter Password"
                    className="w-full px-4 py-2 border border-white rounded-md text-white placeholder-white bg-transparent"
                    {...register('password', {
                        required: 'Password is required',
                        minLength: {
                            value: 6,
                            message: 'Password must be at least 6 characters',
                        },
                    })}
                />
                {errors.password && <p className="text-red-500 text-sm">{errors.password.message}</p>}
            </div>
            <button
                type="submit"
                className="w-full text-white py-2 bg-[#21A4AD] rounded-md hover:bg-[#3a6164]"
            >
                Login
            </button>

            <button
                type="button"
                className="mt-4 text-sm text-blue-400 hover:underline"
                onClick={onForgotPassword}
            >
                Forgot Password?
            </button>
        </form>
    );
}

export default LoginForm;
