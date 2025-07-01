"use client";
import React from 'react';
import { useForm } from 'react-hook-form';

function ResetPasswordForm({ onCancel }) {
    const { register, handleSubmit, formState: { errors } } = useForm();
    const [emailSent, setEmailSent] = React.useState(false);

    const onSubmit = (data) => {
        console.log("Reset Email Sent To:", data.resetEmail);
        setEmailSent(true);
    };

    return (
        <div className="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center">
            <div className="bg-white p-6 rounded-xl w-full max-w-sm shadow-lg">
                <h3 className="text-lg font-semibold mb-4">Reset Password</h3>
                {emailSent ? (
                    <p className="text-green-600">Check your email for a reset link.</p>
                ) : (
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <div className="mb-4">
                            <label className="block text-sm font-medium mb-1">Email</label>
                            <input
                                type="email"
                                className="w-full px-4 py-2 border rounded-md"
                                placeholder="Enter your Email"
                                {...register('resetEmail', {
                                    required: 'Email is required',
                                    pattern: {
                                        value: /^\S+@\S+$/i,
                                        message: 'Enter a valid email address',
                                    },
                                })}
                            />
                            {errors.resetEmail && <p className="text-red-500 text-sm">{errors.resetEmail.message}</p>}
                        </div>
                        <div className="flex justify-between">
                            <button
                                type="submit"
                                className="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                            >
                                Send Reset Link
                            </button>
                            <button
                                type="button"
                                className="text-sm text-gray-600 hover:underline"
                                onClick={onCancel}
                            >
                                Cancel
                            </button>
                        </div>
                    </form>
                )}
            </div>
        </div>
    );
}

export default ResetPasswordForm;
