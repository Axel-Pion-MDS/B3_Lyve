import './LogIn.css'

export const LogIn = () => {
  return (
    <div>
      <form>
        <label>
          Email :
          <input type="text" name="name" />
        </label>
        <label>
          Password :
          <input type="password" name="password" />
        </label>
        <input type="submit" value="Envoyer" />
      </form>
    </div>
  )
}

