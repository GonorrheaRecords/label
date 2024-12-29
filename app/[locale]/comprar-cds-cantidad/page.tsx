'use client'

import { useState } from 'react'
import Image from 'next/image'
import { useTranslations } from 'next-intl'
import { Button } from "@/components/ui/button"
import { getShippingOptions, getProductImageUrl } from '@/lib/kunaki-api'

export default function ComprarCDsCantidad() {
  const t = useTranslations('cdsQuantity')
  const [shippingOptions, setShippingOptions] = useState([])

  const handleCheckStock = async () => {
    try {
      const options = await getShippingOptions({
        Country: 'United States',
        State_Province: 'NY',
        PostalCode: '10004',
        Products: [
          { ProductId: 'PXZZ111111', Quantity: 1 }
        ]
      })
      setShippingOptions(options)
    } catch (error) {
      console.error('Error fetching shipping options:', error)
    }
  }

  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold mb-4">{t('title')}</h1>
      <p className="mb-4">{t('description')}</p>
      
      <div className="space-y-4">
        <Button onClick={handleCheckStock}>
          {t('buttonText')}
        </Button>

        {shippingOptions.length > 0 && (
          <div className="mt-4">
            <h2 className="text-xl font-semibold mb-2">Shipping Options:</h2>
            <ul>
              {shippingOptions.map((option, index) => (
                <li key={index} className="mb-2">
                  {option.Description} - {option.DeliveryTime} - ${option.Price}
                </li>
              ))}
            </ul>
          </div>
        )}

        <div className="mt-8">
          <p className="text-lg mb-4">{t('previewText')}:</p>
          <div className="border border-gray-200 rounded-lg overflow-hidden">
            <Image
              src={getProductImageUrl('PXZZ111111', 'front')}
              alt="Product preview"
              width={300}
              height={300}
              className="w-full"
            />
          </div>
        </div>
      </div>
    </div>
  )
}

