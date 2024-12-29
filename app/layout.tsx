import Link from 'next/link'
import { Inter } from 'next/font/google'

const inter = Inter({ subsets: ['latin'] })

export const metadata = {
  title: 'Gonorrhea Records',
  description: 'Tienda oficial de Gonorrhea Records',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="es">
      <body className={inter.className}>
        <header className="bg-black text-white p-4">
          <nav className="container mx-auto flex justify-between items-center">
            <Link href="/" className="text-2xl font-bold">
              Gonorrhea Records
            </Link>
            <ul className="flex space-x-4">
              <li><Link href="/comprar-cds-cantidad" className="hover:text-gray-300">Comprar CDs en cantidad</Link></li>
              <li><Link href="/comprar-cd-individual" className="hover:text-gray-300">Comprar CD individual</Link></li>
              <li><Link href="/unirse" className="hover:text-gray-300">Quiero unirme</Link></li>
              <li><Link href="/sobre-nosotros" className="hover:text-gray-300">Sobre Nosotros</Link></li>
            </ul>
          </nav>
        </header>
        <main className="container mx-auto mt-8">
          {children}
        </main>
      </body>
    </html>
  )
}

