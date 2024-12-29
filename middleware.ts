import createMiddleware from 'next-intl/middleware';
 
export default createMiddleware({
  // Lista de locales soportados
  locales: ['en', 'es'],
  
  // Locale por defecto
  defaultLocale: 'es',
});
 
export const config = {
  matcher: ['/((?!api|_next|.*\\..*).*)']
};

