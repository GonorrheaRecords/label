'use client'

export default function ComprarCDsCantidad() {
  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold mb-4">Comprar CDs en cantidad</h1>
      <p className="mb-4">Aquí puedes comprar CDs en grandes cantidades para distribución o colección.</p>
      
      <div className="space-y-4">
        <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          <a 
            href="https://kunaki.com/msales.asp?PublisherId=207628&pp=1" 
            className="text-white no-underline"
          >
            Click aquí para verificar el stock de CDs
          </a>
        </button>

        <div className="w-full h-[800px] border border-gray-200 rounded-lg">
          <iframe 
            src="https://kunaki.com/msales.asp?PublisherId=207628&pp=1"
            className="w-full h-full"
            title="Kunaki Stock Checker"
          />
        </div>
      </div>
    </div>
  )
}

