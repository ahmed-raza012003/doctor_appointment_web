import React from 'react'
import Image from 'next/image'

const About = () => {
  return (
    <div>
        <h2>About Us</h2>
        <span>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis consequatur maxime in voluptates at placeat cum nesciunt ex eius! Asperiores saepe magnam numquam labore odio ea odit provident minus vero, aperiam fugit dolore rem error voluptates? Alias quidem similique provident nesciunt expedita tempora?</span>


        <section className='grid grid-cols-4'>
        <Image
            src="/Doctor Images/img1.webp"
            width={200}
            height={100}
            alt='Doctor patent'
        />
        <Image
            src="/Doctor Images/img1.webp"
            width={200}
            height={100}
            alt='Doctor patent'
        />
        <Image
            src="/Doctor Images/img1.webp"
            width={200}
            height={100}
            alt='Doctor patent'
        />
        <Image
            src="/Doctor Images/img1.webp"
            width={200}
            height={100}
            alt='Doctor patent'
        />
</section>
    </div>
  )
}

export default About