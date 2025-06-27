import React from 'react'
import Faq from './components/Faq'
import Review_section from './components/Review_section'
import Section1 from './components/Section1'
export const page = () => {
  return (
    <main className='flex flex-col gap-2 min-h-screen'>
      
      <Section1 />
      <Faq />
      <Review_section />



      
    </main>
  )
}

export default page